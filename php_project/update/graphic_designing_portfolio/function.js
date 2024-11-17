
function show_loading(){
    document.querySelector('.loader').classList.add('active');
}

function hide_loading(){
    document.querySelector('.loader').classList.remove('active');
}

window.addEventListener('scroll', function() {
    const profileImg = document.querySelector('.profile-img');
    const rect = profileImg.getBoundingClientRect();

    if (rect.top >= 0 && rect.bottom <= window.innerHeight) {
        profileImg.classList.add('animate-border');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const profileImg = document.querySelector('.profile-img');
    profileImg.classList.add('animate-border');
});

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function randomizeTextFall() {
    const heroText = document.querySelector('#hero h1');
    const heroParagraph = document.querySelector('#hero p');
    
    const randomTranslateY = getRandomInt(20, 100);

    const randomDuration = getRandomInt(1500, 3000);
    
    heroText.style.setProperty('--random-translate-y', `${randomTranslateY}px`);
    heroText.style.animationDuration = `${randomDuration}ms`;

    const randomDelay = getRandomInt(0, 1000);
    heroParagraph.style.animationDelay = `${randomDelay}ms`;
}


window.addEventListener('DOMContentLoaded', function() {
    randomizeTextFall();
});


document.querySelectorAll('.nav-link').forEach(link => {
    link.addEventListener('click', function(e) {
        e.preventDefault();
        
        document.querySelectorAll('.nav-link').forEach(link => link.classList.remove('active'));
        
        // Add active class to the clicked link
        this.classList.add('active');
    });
});

// JavaScript to shrink and move the profile image when scrolling
window.addEventListener('scroll', function() {
    const profileImage = document.querySelector('.profile-img');
    
    // Check if the user has scrolled down more than 100px
    if (window.scrollY > 300) {
        profileImage.classList.add('shrink');
    } else {
        profileImage.classList.remove('shrink');
    }
});

document.getElementById('copy-btn').addEventListener('click', function () {
    const phoneNumber = document.getElementById('phone-number').textContent;
    navigator.clipboard.writeText(phoneNumber).then(() => {
        document.querySelector('i').style="color: green";
        document.querySelector('i').classList.replace('fa-times', 'fa-copy');
        document.querySelector('.show_error').innerHTML = `Phone number copied to clipboard!.`;
        document.querySelector('.dialog').classList.add('active');
    }).catch(err => {
        console.error('Failed to copy: ', err);
    });
});


// Initialize EmailJS
(function () {
    emailjs.init("dzcfZdSpSzoeUbIr0"); // Initialize EmailJS with your public key
})();

document.getElementById('contact-form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent default form submission

    // Validate form fields
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();
    show_loading();

    if (!name || !email || !message) {
        hide_loading();
        document.querySelector('.show_error').innerText = "Please fill out all fields before submitting.";
        document.querySelector('.dialog').classList.add('active');
        return;
    }

    // Send form data using EmailJS
    emailjs
        .send("service_tahf6d6", "template_ht8lf91", {
            from_name: name,
            user_email: email,
            user_name: name,
            message: message,
            reply_to: "kelvinenosdzah2@gmail.com",
        })
        .then(function (response) {
            document.querySelector('i').style="color: green";
            document.querySelector('i').classList.replace('fa-times', 'fa-check');
            hide_loading();
            document.querySelector('.show_error').innerHTML = `Message sent successfully! <br>Your request will be granted.`;
            document.querySelector('.dialog').classList.add('active');
        })
        .catch(function (error) {
            hide_loading();
            console.error('Failed to send message:', error);
            document.querySelector('.show_error').innerText = "Oops! Something went wrong...";
            document.querySelector('.dialog').classList.add('active');
        });
});


let intValue = parseInt(localStorage.getItem('intValue')) || 0;
let lastCheckedYear = parseInt(localStorage.getItem('lastCheckedYear')) || new Date().getFullYear();

const currentYear = new Date().getFullYear();


if (currentYear > lastCheckedYear) {
    intValue += 1;
    localStorage.setItem('intValue', intValue); 
    localStorage.setItem('lastCheckedYear', currentYear); 
}

if((intValue == 0) && (currentYear == lastCheckedYear)){
    document.querySelector('.year').innerHTML= 5;
}
document.querySelector('.year').innerHTML= 5 + intValue;
// Log the value for testing
// alert(`Value: ${intValue}, Year: ${currentYear}`);

document.addEventListener('contextmenu', function(event) {
    event.preventDefault();
    document.querySelector('.show_error').innerText = "Right-click is disabled on this page";
    document.querySelector('.dialog').classList.add('active');
});

document.addEventListener('keydown', function(event) {
    if (
        (event.ctrlKey && event.key === 's') ||
        (event.ctrlKey && event.key === 'p') ||
        (event.ctrlKey && event.key === 'c') ||
        (event.metaKey && event.key === 's') || 
        (event.metaKey && event.key === 'p') || 
        (event.metaKey && event.key === 'c')  
    ) {
        event.preventDefault();
        //alert("This action is disabled.");
        document.querySelector('.show_error').innerText = "This action is disabled.";
        document.querySelector('.dialog').classList.add('active');
    }
});

document.querySelector('.disable').addEventListener('click', () => {
    document.querySelector('.dialog').classList.remove('active');
    document.querySelector('.show_error').innerText="";
    location.reload(true);
});

let api_site;

async function fetchAll() {
    try {
        const response = await fetch("data.json");

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();
        let items = '';  // Initialize items as an empty string

        console.log('Data received:', data);
        data.forEach((work, index) => {
            items += `
                <div class="col-md-4 portfolio-item" data-category="logo">
                    <div class="card bg-dark text-light">
                        <img src="${work.image}" class="card-img-top" alt="Logo Project ${index}">
                        <div class="card-body">
                            <h5 class="card-title">${work.title}</h5>
                        </div>
                    </div>
                </div>
            `;
        });

        // Render the items in a container (example: '.portfolio-container')
        document.querySelector('.portfolio-container').innerHTML = items;
    } catch (error) {
        console.error('There was a problem with the fetch operation:', error);
    }
}
document.addEventListener("DOMContentLoaded", fetchAll);


// Call the function to fetch data
// fetchAll();

// async function fetchLogo(api_site){
//     fetch(api_site)
//     .then(response => {
//         if (!response.ok) {
//         throw new Error('Network response was not ok');
//         }
//         return response.json();
//     })
//     .then(data => {
//         let items;
//         console.log('Data received:', data);
//         data.forEach((work, index) => {
//             if(work.type == "logo"){
//                 items += `
//                 <div class="col-md-4 portfolio-item" data-category="logo">
//                     <div class="card bg-dark text-light">
//                         <img src="${work.image}" class="card-img-top" alt="Logo Project ${index}">
//                         <div class="card-body">
//                             <h5 class="card-title">${work.title}</h5>
//                     </div>
//                 </div>
//             `;
//             }
            
//         });
//     })
//     .catch(error => {
//         console.error('There was a problem with the fetch operation:', error);
//     });
// }

// async function fetchOther(api_site){
//     fetch(api_site)
//     .then(response => {
//         if (!response.ok) {
//         throw new Error('Network response was not ok');
//         }
//         return response.json();
//     })
//     .then(data => {
//         let items;
//         console.log('Data received:', data);
//         data.forEach((work, index) => {
//             if(work.type == "others"){
//                 items += `
//                 <div class="col-md-4 portfolio-item" data-category="logo">
//                     <div class="card bg-dark text-light">
//                         <img src="${work.image}" class="card-img-top" alt="Logo Project ${index}">
//                         <div class="card-body">
//                             <h5 class="card-title">${work.title}</h5>
//                     </div>
//                 </div>
//             `;
//             }
            
//         });
//     })
//     .catch(error => {
//         console.error('There was a problem with the fetch operation:', error);
//     });
// }

// fetchAll("http://localhost/project/update/data.json");

// function all(){
//     fetchAll("http://localhost/project/update/data.json");
// }

// function logo(){
//     fetchLogo("http://localhost/project/update/data.json");
// }

// function other(){
//     fetchOther("http://localhost/project/update/data.json");
// }