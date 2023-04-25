const tableBody = document.querySelector("tbody");
const searchInput = document.getElementById("base-search-input");

const addTableClicks = () => {
    const accorddionButtons = document.querySelectorAll(".base-table-first-cell a");
    const btns = [...accorddionButtons];

    btns.forEach((btn) => {
        btn.addEventListener("click", () => toggleAccoridionClick(btn));
    });

    const removeButtons = document.querySelectorAll(".user-remove-btn");
    removeButtons.forEach((btn) => {
        btn.addEventListener("click", removeUser)
    });
}

function removeUser() {
    const id_user = this.closest("tr").getAttribute("user-id");


    const data = {id_user: parseInt(id_user)};

    fetch("/removeUser", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        search();
    }).catch((err) => {
        alert("coulnt remove this user" + err);
    });
}

function search() {
    const searchValue = searchInput.value;
    const data = {search: searchValue};

    fetch("/searchUser", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then((users) => {
        tableBody.innerHTML = "";
        users.forEach(user => {
            pushUserToTable(user);
        });
    }).then(() => {
        addTableClicks();
    }).catch((err) => {
        alert("refresh table error" + err);
    });

}

function pushUserToTable(user) {
    const template = document.querySelector("#user-row-template");

    try {
        const clone = template.content.cloneNode(true);
        clone.querySelector('tr').setAttribute("user-id", user.id);
        clone.querySelector('span[my-role="user-email"]').innerHTML = user.email;
        clone.querySelector('td[my-role="user-isAdmin"]').innerHTML = user.is_admin;

        var idUser = document.getElementById("hidden-id-user-section").getAttribute("user-id");
        idUser = parseInt(idUser);

        if (idUser === user.id) { // hide remove button to not try to delete own account
            clone.querySelector('a.user-remove-btn').style.display = "none";
        }

        tableBody.appendChild(clone);

    } catch (err) {
        console.error(err);
    }
}

searchInput.addEventListener("keyup", () => {
    setTimeout(() => {
        search()
    }, 100);
});


addTableClicks();
