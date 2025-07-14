window.initAddressAutocomplete = function (input) {
    input.addEventListener("input", async function () {
        const query = input.value;
        if (query.length < 3) return;

        const response = await fetch("https://maps-data.p.rapidapi.com/search-address?query=" + encodeURIComponent(query), {
            method: "GET",
            headers: {
                "X-RapidAPI-Host": "maps-data.p.rapidapi.com",
                "X-RapidAPI-Key": document.querySelector('meta[name="rapidapi-key"]').getAttribute("content")
            }
        });

        const data = await response.json();
        if (data.data && data.data.length > 0) {
            input.value = data.data[0].fullAddress;
        }
    });
};