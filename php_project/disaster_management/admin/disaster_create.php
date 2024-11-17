<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Add a Disater
                 <a href="disaster.php" class="btn btn-primary float-end">Disaster</a>
               </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                 <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="">Type</label>
                        <input type="text" name="type" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Date of Event</label>
                        <input name="date_of_event" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">City or town of the event</label>
                        <input name="loc_of_event" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Picture of the event</label>
                        <input name="pic_of_event" type="file" id="" class="form-control" accept="image/jpeg,image/jpg">
                    </div>
                    <div class="mb-3">
                        <label for="">Description</label>
                        <textarea name="description" id="" rows="3" class="form-control mySummerNote"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="high">High</option>
                            <option value="moderate">Moderate</option>
                            <option value="low">Low</option>
                            <option value="very_high">Very High</option>
                        </select>
                    </div>
                     <div class="mb-3">
                        <button type="submit" id="sub" name="disasterSave" class="btn btn-primary">Save</button>
                     </div>
                 </form>
            </div>
        </div>
    </div>
   </div>
   <script>
       
// const form = document.querySelector("form"),
// continueBtn = form.querySelector("#sub"),


// form.onsubmit = (e)=>{
//     e.preventDefault();
// }

// continueBtn.onclick = ()=>{
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "code.php", true);
//     xhr.onload = ()=>{
//       if(xhr.readyState === XMLHttpRequest.DONE){
//           if(xhr.status === 200){
//               let data = xhr.response;
//           }
//       }
//     }
//     let formData = new FormData(form);
//     xhr.send(formData);
// }


const form = document.querySelector('form');



form.addEventListener('click', () => {
    uploadFile(fileName);

});




function uploadFile(name){
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "code.php");
    
    }
        

        
    let formData = new FormData(form);
    xhr.send(formData);
   </script>
<?php  include('includes/footer.php'); ?>