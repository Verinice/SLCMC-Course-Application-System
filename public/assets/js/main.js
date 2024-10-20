$(function () {
    // Handle user registration
    $("form.register").on("submit", (e) => handleRegistration(e))
    // Handle user login
    $("form.login").on("submit", (e) => handleLogin(e))
    // handle scores update dashboard
    $(".update_badge").on("click", function () {
        const formData = {}
        const score = prompt("What is your kcse score?")
        formData.type = $(this).data('id');
        formData.score = score;
        formData.adm = $(this).data('adm')
        handleStudentScoreUpdate(formData);
    })

    // menu toggle
    $('.bars').on("click", function () {
        $(".menu").show();
        $(".close").on("click", function () {
            $(".menu").hide();
        })
    })

    // on cart add
    $(".cart").on("click", function (e) {
        e.preventDefault()
        const cartItems = getCartItems()
        const action = $(this).data('action');
        if (action === 'add') {
            if (cartItems.length >= 3) {
                alert("Oops!, Max courses reached!")
                return;
            }
            const add = confirm("Add this course to cart?")
            if (!add) {
                return
            }
            const courseId = $(this).data("id")
            addCart(courseId);
            $(this).data('action', 'remove').text("Remove")
        }
        if (action === 'remove') {
            const remove = confirm("Remove this course from cart?")
            if (!remove) {
                return
            }
            const courseId = $(this).data("id")
            removeCart(courseId);
            $(this).data('action', 'add').text("Add to Cart")
        }

        const items = getCartItems();
        $(".continue_btn span").text(items.length)
    })

    // fetch cart
    const cart = getCartItems();
    $(".continue_btn span, .header_info .counter").text(cart.length)
    cart.forEach(courseId => {
        const cardItem = $(`div#course_${courseId}`);
        if (!cardItem) {
            return
        }
        cardItem.find(".cart").data("action", "remove").text("Remove")
    });
    // fetch cart courses by id from api
    cart.length && fetchCourses(cart)

    // application handler
    $(".apply").on("click", (e) => handleApplyCourses(e))
});


function handleApplyCourses(e) {
    e.preventDefault()
    const cartItems = getCartItems();
    $.ajax({
        url: `./api/apply.php`,
        type: 'POST',
        data: { ...cartItems },
        success: function (response) {
            const { applied } = JSON.parse(response)
            if (!applied) {
                alert("Oops, something bad happened, try again")
                return
            }
            // clear cart store
            sessionStorage.removeItem('cart')
            alert("Application successful!")
            window.location.reload()
        },
        error: function (xhr, status, error) {
            alert("Failed, contact admin!");
        }
    })
}

function fetchCourses(cartItems) {
    $.ajax({
        url: `./api/courses.php`,
        type: 'POST',
        data: { ...cartItems },
        success: function (response) {
            const { courses } = JSON.parse(response);
            const listTarget = $(".cart .list")
            for (let i = 0; i < courses.length; i++) {
                const course = courses[i];
                const html = `<div class="list" id=${course.id}>
                    <h1>${i + 1} - ${course.name}</h1>
                    <div class="vii_info"><span>Duration</span><span>${course.modules} modules</span></div>
                    <hr/>
                    <div class="vii_info"><span>Online opt</span><span>${course.online_opt === '0' ? "None" : "Online"}</span></div>
                    <hr/>
                </div>`
                listTarget.append(html);
            }

        },
        error: function (xhr, status, error) {
            alert("Failed, contact admin!");
        }
    })
}

function getCartItems() {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || []
    cart = cart.reduce(function (accumulator, current) {
        if (!accumulator.includes(current)) {
            accumulator.push(parseInt(current));
        }
        return accumulator;
    }, []);
    return cart;
}

function removeCart(courseId) {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    cart = cart.filter((id) => id !== courseId)
    sessionStorage.setItem('cart', JSON.stringify(cart));
}

function addCart(courseId) {
    let cart = JSON.parse(sessionStorage.getItem('cart')) || [];
    cart.push(courseId);
    sessionStorage.setItem('cart', JSON.stringify(cart));
}

function handleStudentScoreUpdate(formData) {
    console.log(formData)
    if (!formData.type || !formData.score || !formData.adm) {
        alert("Invalid data, try again!")
        return;
    }
    // submit data to api
    $.ajax({
        url: `./api/update.php`,
        type: 'POST',
        data: formData,
        success: function (response) {
            const { updated } = JSON.parse(response);
            if (updated) {

                if (formData.type === 'kcpe_score') {
                    $("#kcpe_card .update_badge").remove();
                    $("#kcpe_card .card-body h1").after(`<div id="${formData.type}">Score: ${formData.score} marks</div>`);
                } else {
                    $("#kcse_card .update_badge").remove();
                    $("#kcse_card .card-body h1").after(`<div id="${formData.type}">Score: ${formData.score} points</div>`);
                }
            }
        },
        error: function (xhr, status, error) {
            alert("Failed, contact admin!");
        }
    })
}

function handleRegistration(e) {
    e.preventDefault()
    const formData = {}
    formData.name = $("form.register #name").val()
    formData.email = $("form.register #email").val()
    formData.phone = $("form.register #phone").val()
    formData.password = $("form.register #password").val()
    formData.confirmPassword = $("form.register #conf_password").val()
    formData.terms = $("form.register #terms").prop('checked')
    console.log(formData.terms)
    // validate form values
    if (!formData.name || !formData.password || !formData.phone || !formData.confirmPassword) {
        alert("All fields required!")
        return;
    }

    // validate passwords match
    if (formData.password !== formData.confirmPassword) {
        alert("Password mismatch!")
        return;
    }

    // confirm terms of use
    if (!formData.terms) {
        alert("Confirm read terms of use")
        return
    }

    // submit to backend in ajax
    $.ajax({
        url: `./api/register.php`,
        type: 'POST',
        data: formData,
        success: function (response) {
            const { created } = JSON.parse(response);
            if (created) {
                alert("Sudent created successfully!");
            }
        },
        error: function (xhr, status, error) {
            alert("Failed, contact admin!");
        }
    })
}

function handleLogin(e) {
    e.preventDefault();
    const formData = {}
    formData.email = $("form.login #email").val()
    formData.password = $("form.login #password").val()
    console.log(formData)

    // validate form values
    if (!formData.email || !formData.password) {
        alert("All fields required!")
        return;
    }

    // submit to backend in ajax
    $.ajax({
        url: `./api/login.php`,
        type: 'POST',
        data: formData,
        success: function (response) {
            const { adm, email, username } = JSON.parse(response);
            if (adm && email && username) {
                window.location.href = './dashboard';
            }
        },
        error: function (xhr, status, error) {
            alert("Failed, contact admin!");
        }
    })
}