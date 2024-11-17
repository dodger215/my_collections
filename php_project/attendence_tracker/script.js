const pop_up = document.querySelector('.pop_up');

let main = `<div class="cover"></div>
    <div class="pop">
        <div class="close" onclick="close()"><a href="index.php">&times;</a></div>
        <div class="register">
            <form action="php/register.php" method="post" autocomplete="off">
                <h1>Registration</h1>
                <div class="fname">
                    <input type="text" name="fname" required/>
                    <span>Your first name:</span>
                </div>
                <div class="lname">
                    <input type="text" name="lname" required/>
                    <span>Your last name:</span>
                </div>
                <div class="date_of_birth">
                    <label>Enter your date of birth: </label>
                    <input type="date" name="dateOfBirth">
                </div>
                <div class="tel">
                    <input type="tel" name="number" required/>
                    <span>Your phone number:</span>
                </div>
                <div class="gender">
                    <label>Select your gender</label>
                    <select class="title" name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="status">
                    <label>Select your title in the church</label>
                    <select class="title" name="title">
                        <option value="member">Member</option>
                        <option value="dcn">Dcn.</option>
                        <option value="elder">Elder</option>
                        <option value="pastor">Pastor</option>
                    </select>
                </div>
                <div class="status">
                    <label>Select your status</label>
                    <select class="title" name="status">
                        <option value="married">Married</option>
                        <option value="single">Single</option>
                        <option value="courtship">courtship</option>
                    </select>
                </div>
                <button type="submit">Register</button>
            </form>
        </div>
    </div>`;



pop_up.addEventListener('click', () => {
    document.querySelector('body').innerHTML = main;

    
});



