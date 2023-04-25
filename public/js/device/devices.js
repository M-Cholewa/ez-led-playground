const tableBody = document.querySelector("tbody");
const searchInput = document.getElementById("base-search-input");

const addTableClicks = () => {
    const accorddionButtons = document.querySelectorAll(".base-table-first-cell a");
    const btns = [...accorddionButtons];

    btns.forEach((btn) => {
        btn.addEventListener("click", () => toggleAccoridionClick(btn));
    });

    const removeButtons = document.querySelectorAll(".device-remove-btn");
    removeButtons.forEach((btn) => {
        btn.addEventListener("click", removeDevice)
    });
}

function removeDevice() {
    const id_device = this.closest("tr").getAttribute("device-id");


    const data = {id_device: parseInt(id_device)};

    fetch("/removeDevice", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        search();
    }).catch((err) => {
        alert("coulnt remove this device" + err);
    });
}

function search() {
    const searchValue = searchInput.value;
    const data = {search: searchValue};

    fetch("/searchDevice", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then((devices) => {
        tableBody.innerHTML = "";
        devices.forEach(device => {
            pushDeviceToTable(device);
        });
    }).then(() => {
        addTableClicks();
    }).catch((err) => {
        alert("refresh table error" + err);
    });

}

function pushDeviceToTable(device) {
    const template = document.querySelector("#device-row-template");

    try {
        const clone = template.content.cloneNode(true);
        clone.querySelector('tr').setAttribute("device-id", device.id);
        clone.querySelector('span[my-role="device-name"]').innerHTML = device.name;
        clone.querySelector('td[my-role="device-width"]').innerHTML = device.width;
        clone.querySelector('td[my-role="device-height"]').innerHTML = device.height;
        clone.querySelector('td[my-role="device-api-key"]').innerHTML = device.api_key;
        clone.querySelector('td[my-role="device-active-workspace-name"]').innerHTML = device.workspace_name;
        clone.querySelector('a[my-role="device-telemetry-href"]').setAttribute("href", `telemetry?id_device=${device.id}`);

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
