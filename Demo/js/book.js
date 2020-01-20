$("#save").on("click", function () {
    let innerHtml = document.getElementById('save').innerText;
    if (innerHtml === "Save") {

        $.ajax({
            method: "POST",
            url: 'save-book.php',
            data: $("#bookForm").serialize()
        })
            .done(function (msg) {
                alert("Data Saved: " + msg);
                document.getElementById("referenceNumber").value = "";
                document.getElementById("title").value = "";
                document.getElementById("author").value = "";
                location.reload();
            });

    } else {

        $.ajax({
            method: "POST",
            url: 'update-book.php',
            data: $("#bookForm").serialize()
        })
            .done(function (msg) {
                alert("Data Updated: " + msg);
                document.getElementById("referenceNumber").value = "";
                document.getElementById("title").value = "";
                document.getElementById("author").value = "";
                location.reload();
            });
    }

});
// ---------------------------------------------------------------------------------------------------------------------

document.getElementById("reset").addEventListener("click",
    function () {
        document.getElementById("referenceNumber").value = "";
        document.getElementById("title").value = "";
        document.getElementById("author").value = "";
        document.getElementById("save").innerHTML = "Save";
        document.getElementById("save").classList.remove('btn-success');
        document.getElementById("save").classList.add('btn-primary');
        document.getElementById("referenceNumber").readOnly = false;
    });


// ---------------------------------------------------------------------------------------------------------------------

document.getElementById("search").addEventListener("keyup",
    function () {

        let text = document.getElementById("search").value;

        let ajax = new XMLHttpRequest();
        let method = "POST";
        let url = "search-book.php";
        let asynchronous = true;

        ajax.open(method, url, asynchronous);
        ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        ajax.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {

                let data = JSON.parse(this.responseText);

                let html = "";

                for (let a = 0; a < data.length; a++) {

                    let referenceNumber = data[a].reference_number;
                    let category = data[a].category_name;
                    let title = data[a].title;
                    let author = data[a].author;
                    let addedDate = data[a].added_date;
                    let availability = parseInt(data[a].Availability);

                    if (availability === 0) {
                        html += "<tr style='color: red' onclick='getData(this)'>";
                    } else {
                        html += "<tr onclick='getData(this)'>";
                    }
                    html += "<td>" + referenceNumber + "</td>";
                    html += "<td>" + category + "</td>";
                    html += "<td>" + title + "</td>";
                    html += "<td>" + author + "</td>";
                    html += "<td>" + addedDate + "</td>";
                    html += "</tr>";
                }

                document.getElementById("tableBody").innerHTML = html;
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

    document.getElementById("referenceNumber").value = row.cells[0].innerHTML;
    document.getElementById("bookCategory").value = row.cells[1].innerHTML;
    document.getElementById("title").value = row.cells[2].innerHTML;
    document.getElementById("author").value = row.cells[3].innerHTML;

    document.getElementById("referenceNumber").readOnly = true;
    document.getElementById("save").innerHTML = "Update";
    document.getElementById("save").classList.remove('btn-primary');
    document.getElementById("save").classList.add('btn-success');
}

function getBooksForCategory(value) {

    let ajax = new XMLHttpRequest();
    let method = "POST";
    let url = "get-all-books-for-category.php";
    let asynchronous = true;

    ajax.open(method, url, asynchronous);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            let data = JSON.parse(this.responseText);

            let html = "";

            for (let a = 0; a < data.length; a++) {

                let referenceNumber = data[a].reference_number;
                let category = data[a].category_name;
                let title = data[a].title;
                let author = data[a].author;
                let addedDate = data[a].added_date;
                let availability = parseInt(data[a].Availability);

                if (availability === 0) {
                    html += "<tr style='color: red' onclick='getData(this)'>";
                } else {
                    html += "<tr onclick='getData(this)'>";
                }
                html += "<td>" + referenceNumber + "</td>";
                html += "<td>" + category + "</td>";
                html += "<td>" + title + "</td>";
                html += "<td>" + author + "</td>";
                html += "<td>" + addedDate + "</td>";
                html += "</tr>";
            }

            document.getElementById("tableBody").innerHTML = html;
        }
    };

    let data = "category=" + value;
    ajax.send(data);
}

function getBooksForAuthor(value) {

    console.log(this.value);
    let ajax = new XMLHttpRequest();
    let method = "POST";
    let url = "get-all-books-for-author.php";
    let asynchronous = true;

    ajax.open(method, url, asynchronous);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {

            let data = JSON.parse(this.responseText);

            let html = "";

            for (let a = 0; a < data.length; a++) {

                let referenceNumber = data[a].reference_number;
                let category = data[a].category_name;
                let title = data[a].title;
                let author = data[a].author;
                let addedDate = data[a].added_date;
                let availability = parseInt(data[a].Availability);

                if (availability === 0) {
                    html += "<tr style='color: red' onclick='getData(this)'>";
                } else {
                    html += "<tr onclick='getData(this)'>";
                }
                html += "<td>" + referenceNumber + "</td>";
                html += "<td>" + category + "</td>";
                html += "<td>" + title + "</td>";
                html += "<td>" + author + "</td>";
                html += "<td>" + addedDate + "</td>";
                html += "</tr>";
            }

            document.getElementById("tableBody").innerHTML = html;
        }
    };

    let data = "author=" + value;
    ajax.send(data);
}
