// Get all course links.
var courseLinks = document.getElementsByClassName('course-link');

// Add a click event listener to each course link.
for (var i = 0; i < courseLinks.length; i++) {
   courseLinks[i].addEventListener('click', function(event) {
       // Prevent the default action.
       event.preventDefault();

       // Get the course id from the data attribute.
       var courseid = event.target.dataset.courseid;

       // Fetch the students for the course.
       fetchStudents(courseid);
   });
}

function fetchStudents(courseid) {
 var xhr = new XMLHttpRequest();
 xhr.open('GET', '/blocks/view_learners/fetchstudents.php?courseid=' + courseid, true);
 xhr.onload = function () {
     if (xhr.status == 200) {
         var students = JSON.parse(xhr.responseText);
         var output = '';
         for (var i = 0; i < students.length; i++) {
             output += '<div>' + students[i].firstname + ' ' + students[i].lastname + '</div>';
         }
         document.getElementById('studentContainer').innerHTML = output;
     }
 };
 xhr.send();
}

  