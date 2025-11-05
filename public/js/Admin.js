async function sendRequest(id, approve) {

    const token = document.querySelector('meta[name="csrf-token"]').content;

    const response = await fetch(`/admin/${id}`, {
        method: "POST",
        credentials: "same-origin",
        body: JSON.stringify({
            "approve": approve
        }),
        headers: {
            "Content-type": "application/json; charset=UTF-8",
            "X-CSRF-TOKEN": token,
        }
    });

    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }

}


document.addEventListener('DOMContentLoaded', function () {
    const requests = document.querySelectorAll(".request");

    requests.forEach(element => {
        const approve = element.querySelector("#approve")
        const reject = element.querySelector("#ban")
        const id = element.dataset.id

        approve.addEventListener('click',async e => {
            try {
                await sendRequest(id, true)
                element.remove()
            } catch(er) {
                console.log(er)
            }
            
        })

        reject.addEventListener('click',async e => {
            try {
                await sendRequest(id, false)
                element.remove()
            } catch(er) {
                console.log(er)
            }
            
        })
    });

})