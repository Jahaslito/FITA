// // var listDownBtn = document.getElementById("list-down");
// // var listUpBtn = document.getElementById("list-up");
// var subList = document.getElementById("sub-list");

// var moreListDownBtn = document.getElementById("more-list-down");
// var moreListUpBtn = document.getElementById("more-list-up");
// var moreSubList = document.getElementById("more-sub-list");

// // listDownBtn.onclick= function() {
// //     subList.style.display="flex";
// //     listDownBtn.style.display="none";
// //     listUpBtn.style.display="block";
// // };

// // listUpBtn.onclick= function() {
// //     subList.style.display="none";
// //     listDownBtn.style.display="block";
// //     listUpBtn.style.display="none";
// // };

// moreListDownBtn.onclick= function() {
//     moreSubList.style.display="flex";
//     moreListDownBtn.style.display="none";
//     moreListUpBtn.style.display="block";
// };

// moreListUpBtn.onclick= function() {
//     moreSubList.style.display="none";
//     moreListDownBtn.style.display="block";
//     moreListUpBtn.style.display="none";
// };
var openlistButton= document.getElementById('dropdown-icon');
var closelistButton= document.getElementById('closeup-icon');
var dropdownContent = document.getElementsByClassName('dropdown-content')[0];
function showDropDown() {
    dropdownContent.style.display="block";
    closelistButton.style.display="block";
    openlistButton.style.display="none";
}

function closeDropDown() {
    dropdownContent.style.display="none";
    closelistButton.style.display="none";
    openlistButton.style.display="block";
}
