$("#userSave").on("click", function () {
    let innerHtml = document.getElementById('userSave').innerText;
    if (innerHtml === "Save") {

        $.ajax({
            method: "POST",
            url: 'save-user.php',
            data: $("#userFrom").serialize()
        })
            .done(function (msg) {
                alert("Data Saved: " + msg);
                document.getElementById("email").value = "";
                document.getElementById("firstName").value = "";
                document.getElementById("lastName").value = "";
                document.getElementById("postalAddress").value = "";
                document.getElementById("contactNumber").value = "";
                location.reload();
            });

    } else {

        $.ajax({
            method: "POST",
            url: 'update-user.php',
            data: $("#userFrom").serialize()
        })
            .done(function (msg) {
                alert("Data Updated: " + msg);
                document.getElementById("email").value = "";
                document.getElementById("firstName").value = "";
                document.getElementById("lastName").value = "";
                document.getElementById("postalAddress").value = "";
                document.getElementById("contactNumber").value = "";
                location.reload();
            });
    }

});
// ---------------------------------------------------------------------------------------------------------------------

document.getElementById("userReset").addEventListener("click",
    function () {
        document.getElementById("email").value = "";
        document.getElementById("firstName").value = "";
        document.getElementById("lastName").value = "";
        document.getElementById("postalAddress").value = "";
        document.getElementById("contactNumber").value = "";

        document.getElementById("userSave").innerHTML = "Save";
        document.getElementById("userSave").classList.remove('btn-success');
        document.getElementById("userSave").classList.add('btn-primary');
        document.getElementById("email").readOnly = false;
    });

// ---------------------------------------------------------------------------------------------------------------------

document.getElementById("userSearch").addEventListener("keyup",
    function () {

        let text = document.getElementById("userSearch").value;

        let ajax = new XMLHttpRequest();
        let method = "POST";
        let url = "search-user.php";
        let asynchronous = true;

        ajax.open(method, url, asynchronous);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {

                console.log(this.responseText);
                let data = JSON.parse(this.responseText);

                let html = "";

                for (let a = 0; a < data.length; a++) {

                    let email = data[a].email;
                    let firstName = data[a].first_name;
                    let lastName = data[a].last_name;
                    let address = data[a].address;
                    let contactNo = data[a].contact_number;
                    let regDate = data[a].reg_date;

                    html += "<tr onclick='getData(this)'>";
                    html += "<td>" + email + "</td>";
                    html += "<td>" + firstName + "</td>";
                    html += "<td>" + lastName + "</td>";
                    html += "<td>" + address + "</td>";
                    html += "<td>" + contactNo + "</td>";
                    html += "<td>" + regDate + "</td>";
                    html += "</tr>";
                }

                document.getElementById("userTableBody").innerHTML = html;
            }
        };

        let data = "text=" + text;
        ajax.send(data);
    });

// ---------------------------------------------------------------------------------------------------------------------
//
// let table = document.getElementById('bookTable');
//
// for (let i = 1; i < table.rows.length; i++) {
//
//     table.rows[i].onclick = function () {
//
//         document.getElementById("referenceNumber").value = this.cells[0].innerHTML;
//         document.getElementById("title").value = this.cells[1].innerHTML;
//         document.getElementById("author").value = this.cells[2].innerHTML;
//
//         document.getElementById("referenceNumber").readOnly = true;
//         document.getElementById("save").innerHTML = "Update";
//         document.getElementById("save").classList.remove('btn-primary');
//         document.getElementById("save").classList.add('btn-success');
//
//     };
// }


function getData(row) {

    document.getElementById("email").value = row.cells[0].innerHTML;
    document.getElementById("firstName").value = row.cells[1].innerHTML;
    document.getElementById("lastName").value = row.cells[2].innerHTML;
    document.getElementById("postalAddress").value = row.cells[3].innerHTML;
    document.getElementById("contactNumber").value = row.cells[4].innerHTML;

    document.getElementById("email").readOnly = true;
    document.getElementById("userSave").innerHTML = "Update";
    document.getElementById("userSave").classList.remove('btn-primary');
    document.getElementById("userSave").classList.add('btn-success');
}