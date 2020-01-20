let bookReferenceNumbers = [];
let userContactNumbers = [];
let userEmails = [];

function getAllUserEmails() {

    let ajax = new XMLHttpRequest();
    let method = "POST";
    let url = "get-all-users.php";
    let asynchronous = true;

    ajax.open(method, url, asynchronous);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            let data = JSON.parse(this.responseText);

            let html = "";

            for (let a = 0; a < data.length; a++) {

                let email = data[a].email;
                userEmails.push(email);
            }

            return userEmails;
        }
    };

    ajax.send();
}

function getAllUserContactNumbers() {

    let ajax = new XMLHttpRequest();
    let method = "POST";
    let url = "get-all-users.php";
    let asynchronous = true;

    ajax.open(method, url, asynchronous);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            let data = JSON.parse(this.responseText);

            let html = "";

            for (let a = 0; a < data.length; a++) {

                let contactNumber = data[a].contact_number;
                userContactNumbers.push(contactNumber);
            }

            return userContactNumbers;
        }
    };

    ajax.send();
}

function getAllBookReferenceNumbers() {

    let ajax = new XMLHttpRequest();
    let method = "POST";
    let url = "get-all-books-for-category.php";
    let asynchronous = true;

    ajax.open(method, url, asynchronous);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            let data = JSON.parse(this.responseText);

            for (let a = 0; a < data.length; a++) {

                let referenceNumber = data[a].reference_number;
                bookReferenceNumbers.push(referenceNumber);
            }

        }
    };

    let data = "category=" + "CURRENT";
    ajax.send(data);
}

getAllBookReferenceNumbers();
getAllUserEmails();
getAllUserContactNumbers();

autocomplete("contactNumber", document.getElementById("bookIssueContactNumber"), userContactNumbers);
autocomplete("email", document.getElementById("bookIssueUserEmail"), userEmails);
autocomplete("refNo", document.getElementById("bookIssueReferenceNumber"), bookReferenceNumbers);

function autocomplete(name, inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    let currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
        let a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() === val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        let x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode === 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus letiable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode === 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus letiable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode === 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) {
                    x[currentFocus].click();

                    if (name === "contactNumber") {
                        getUserForContactNo(x[currentFocus].innerText);
                    } else if (name === "email") {
                        getUserForEmail(x[currentFocus].innerText);
                    } else if (name === "refNo") {
                        getBookForRefNo(x[currentFocus].innerText);
                    }
                }
            }
        }
    });

    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (let i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        let x = document.getElementsByClassName("autocomplete-items");
        for (let i = 0; i < x.length; i++) {
            if (elmnt !== x[i] && elmnt !== inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}

Date.prototype.addDays = function (days) {
    let date = new Date(this.valueOf());
    date.setDate(date.getDate() + days);
    return date;
};

let currentDate = new Date();
let dateOfReturn = currentDate.addDays(7);

function convertDate(givenDate) {
    let year = givenDate.getFullYear();

    let month = givenDate.getMonth();
    switch (month) {
        case 0:
            month = "January";
            break;
        case 1:
            month = "February";
            break;
        case 2:
            month = "March";
            break;
        case 3:
            month = "April";
            break;
        case 4:
            month = "May";
            break;
        case 5:
            month = "June";
            break;
        case 6:
            month = "July";
            break;
        case 7:
            month = "August";
            break;
        case 8:
            month = "September";
            break;
        case 9:
            month = "October";
            break;
        case 10:
            month = "November";
            break;
        case 11:
            month = "December";
            break;
        default:
            month = "no month";
    }

    let postFix = "th";
    let date = givenDate.getDate();
    switch (date) {
        case 1:
            postFix = "st";
            break;
        case 2:
            postFix = "nd";
            break;
        case 3:
            postFix = "rd";
            break;
        case 21:
            postFix = "st";
            break;
        case 22:
            postFix = "nd";
            break;
        case 23:
            postFix = "rd";
            break;
        case 31:
            postFix = "st";
            break;
        default:
            postFix = "th";
    }

    let day = givenDate.getDay();
    switch (day) {
        case 0:
            day = "Sunday";
            break;
        case 1:
            day = "Monday";
            break;
        case 2:
            day = "Tuesday";
            break;
        case 3:
            day = "Wednesday";
            break;
        case 4:
            day = "Thursday";
            break;
        case 5:
            day = "Friday";
            break;
        case 6:
            day = "Saturday";
            break;
        default:
            day = "no day";
    }

    return day + " " + date + postFix + " of " + month + " " + year;
}

document.getElementById("dateOfLend").value = convertDate(currentDate);
document.getElementById("dateOfReturn").value = convertDate(dateOfReturn);

function getBookForRefNo(number) {
    let ajax = new XMLHttpRequest();
    let method = "POST";
    let url = "search-book-by-reference-number.php";
    let asynchronous = true;

    ajax.open(method, url, asynchronous);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            let data = JSON.parse(this.responseText);

            for (let a = 0; a < data.length; a++) {

                let referenceNumber = data[a].reference_number;
                let category = data[a].category_name;
                let title = data[a].title;
                let author = data[a].author;
                let addedDate = data[a].added_date;
                let availability = parseInt(data[a].Availability);

                document.getElementById("bookIssueReferenceNumber").value = referenceNumber;
                document.getElementById("bookIssueBookCategory").value = category;
                document.getElementById("bookIssueBookTitle").value = title;
                document.getElementById("bookIssueAuthor").value = author;

                changeBookFieldsReadOnly(true);
            }
        }
    };

    let data = "number=" + number;
    ajax.send(data);
}

function getUserForEmail(email) {

    let ajax = new XMLHttpRequest();
    let method = "POST";
    let url = "search-user-by-email.php";
    let asynchronous = true;

    ajax.open(method, url, asynchronous);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            let data = JSON.parse(this.responseText);

            for (let a = 0; a < data.length; a++) {

                let email = data[a].email;
                let firstName = data[a].first_name;
                let lastName = data[a].last_name;
                let address = data[a].address;
                let contactNo = data[a].contact_number;
                let regDate = data[a].reg_date;

                document.getElementById("bookIssueUserEmail").value = email;
                document.getElementById("bookIssueContactNumber").value = contactNo;
                document.getElementById("bookIssueUserName").value = firstName + " " + lastName;
                document.getElementById("bookIssueUserPostalAddress").value = address;

                changeUserFieldsReadOnly(true);
            }
        }
    };

    let data = "email=" + email;
    ajax.send(data);
}

function getUserForContactNo(contactNo) {

    let ajax = new XMLHttpRequest();
    let method = "POST";
    let url = "search-user-by-contact-number.php";
    let asynchronous = true;

    ajax.open(method, url, asynchronous);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            let data = JSON.parse(this.responseText);

            for (let a = 0; a < data.length; a++) {

                let email = data[a].email;
                let firstName = data[a].first_name;
                let lastName = data[a].last_name;
                let address = data[a].address;
                let contactNo = data[a].contact_number;
                let regDate = data[a].reg_date;

                document.getElementById("bookIssueUserEmail").value = email;
                document.getElementById("bookIssueContactNumber").value = contactNo;
                document.getElementById("bookIssueUserName").value = firstName;
                document.getElementById("bookIssueUserPostalAddress").value = address;

                changeUserFieldsReadOnly(true);
            }
        }
    };

    let data = "contactNo=" + contactNo;
    ajax.send(data);
}

function changeUserFieldsReadOnly(status) {

    document.getElementById("bookIssueUserEmail").readOnly = status;
    document.getElementById("bookIssueContactNumber").readOnly = status;
    document.getElementById("bookIssueUserName").readOnly = status;
    document.getElementById("bookIssueUserPostalAddress").readOnly = status;
}

function changeBookFieldsReadOnly(status) {

    document.getElementById("bookIssueReferenceNumber").readOnly = status;
    document.getElementById("bookIssueBookCategory").readOnly = status;
    document.getElementById("bookIssueBookTitle").readOnly = status;
    document.getElementById("bookIssueAuthor").readOnly = status;
}

function resetFields() {

    document.getElementById("bookIssueReferenceNumber").value = "";
    document.getElementById("bookIssueBookCategory").value = "";
    document.getElementById("bookIssueBookTitle").value = "";
    document.getElementById("bookIssueAuthor").value = "";

    document.getElementById("bookIssueUserEmail").value = "";
    document.getElementById("bookIssueContactNumber").value = "";
    document.getElementById("bookIssueUserName").value = "";
    document.getElementById("bookIssueUserPostalAddress").value = "";
    changeBookFieldsReadOnly(false);
    changeUserFieldsReadOnly(false);

    document.getElementById("bookIssueAddButton").innerHTML = "Lend Book";
    document.getElementById("bookIssueAddButton").classList.remove('btn-success');
    document.getElementById("bookIssueAddButton").classList.add('btn-danger');

    location.reload();
}
function saveLend() {

    let innerHtml = document.getElementById('bookIssueAddButton').innerText;

    let data = {
        "referenceNumber": document.getElementById("bookIssueReferenceNumber").value,
        "email": document.getElementById("bookIssueUserEmail").value,
        "dateOfLend": document.getElementById("dateOfLend").value,
        "dateOfReturn": document.getElementById("dateOfReturn").value
    };

    if (innerHtml === "Lend Book") {

        $.ajax({
            method: "POST",
            url: 'save-lend.php',
            data: data
        })
            .done(function (msg) {
                alert("Data Saved: " + msg);
                location.reload();
            });

    } else {

        $.ajax({
            method: "POST",
            url: 'save-return.php',
            data: data
        })
            .done(function (msg) {
                alert("Data Updated: " + msg);
                location.reload();
            });
    }
}

function getData(row) {

    let refNo = row.cells[0].innerHTML;
    let email = row.cells[1].innerHTML;
    let lendDate = row.cells[2].innerHTML;
    let returnDate = row.cells[3].innerHTML;

    getBookForRefNo(refNo);
    getUserForEmail(email);
    document.getElementById("dateOfLend").value = lendDate;
    document.getElementById("dateOfReturn").value = returnDate;

    document.getElementById("bookIssueAddButton").innerHTML = "Return";
    document.getElementById("bookIssueAddButton").classList.remove('btn-danger');
    document.getElementById("bookIssueAddButton").classList.add('btn-success');
}

