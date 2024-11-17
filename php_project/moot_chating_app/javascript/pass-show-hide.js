const pswrdField = document.querySelector(".form input[type='password']"),
toggleIcon = document.querySelector(".form .field i");

toggleIcon.onclick = () =>{
  if(pswrdField.type === "password"){
    pswrdField.type = "text";
    toggleIcon.classList.add("active");
  }else{
    pswrdField.type = "password";
    toggleIcon.classList.remove("active");
  }
}

const pass = document.querySelector('.login_pass')
const show = document.querySelector('.view');
const hide = document.querySelector('.hide');

show.addEventListener('click', () => {
  pass.type = "text";
});