const tableBody = document.querySelector("tbody");
const searchInput = document.getElementById("base-search-input");

const addTableClicks = () => {
    const accorddionButtons = document.querySelectorAll(".base-table-first-cell a");
    const btns = [...accorddionButtons];

    btns.forEach((btn) => {
        btn.addEventListener("click", () => toggleAccoridionClick(btn));
    });

    const removeButtons = document.querySelectorAll(".workspace-remove-btn");
    removeButtons.forEach((btn) => {
        btn.addEventListener("click", removeWorkspace)
    });
}

function removeWorkspace() {
    const id_workspace = this.closest("tr").getAttribute("workspace-id");
    const data = {id_workspace: parseInt(id_workspace)};

    fetch("/removeWorkspace", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        searchWorkspace();
    }).catch((err) => {
        alert("couldn't remove this workspace" + err);
    });
}

function searchWorkspace() {
    const searchValue = searchInput.value;
    const data = {search: searchValue};

    fetch("/searchWorkspace", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then((device_workspaces) => {
        tableBody.innerHTML = "";
        device_workspaces.forEach(device_workspace => {
            pushToTable(device_workspace);
        });
    }).then(() => {
        addTableClicks();
    }).catch((err) => {
        alert("refresh table error" + err);
    });

}

function pushToTable(device_workspace) {
    const template = document.querySelector("#workspace-row-template");

    try {
        const clone = template.content.cloneNode(true);
        clone.querySelector('tr').setAttribute("workspace-id", device_workspace.workspace_id);
        clone.querySelector('span[my-role="workspace-name"]').innerHTML = device_workspace.workspace_name;
        clone.querySelector('td[my-role="device-name"]').innerHTML = device_workspace.name;
        clone.querySelector('td[my-role="device-width"]').innerHTML = device_workspace.width;
        clone.querySelector('td[my-role="device-height"]').innerHTML = device_workspace.height;
        clone.querySelector('a[my-role="draw-href"]').setAttribute("href", `draw?id_workspace=${device_workspace.workspace_id}`);

        tableBody.appendChild(clone);

    } catch (err) {
        console.error(err);
    }
}

searchInput.addEventListener("keyup", () => {
    setTimeout(() => {
        searchWorkspace()
    }, 100);
});



addTableClicks();
