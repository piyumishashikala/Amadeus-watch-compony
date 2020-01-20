function getTotal() {
    let ajax = new XMLHttpRequest();
    let method = "POST";
    let url = "get-total-data.php";
    let asynchronous = true;

    ajax.open(method, url, asynchronous);
    ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    ajax.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            let data = JSON.parse(this.responseText);

            console.log(data);
            console.log(data.books);
            console.log(data.users);
            console.log(data.authors);
            console.log(data.lends);

            document.getElementById("totalBooks").innerHTML  =data.books;
            document.getElementById("totalReaders").innerHTML=data.users;
            document.getElementById("totalAuthors").innerHTML=data.authors;
            document.getElementById("totalLends").innerHTML  =data.lends;
        }
    };

    ajax.send();
}