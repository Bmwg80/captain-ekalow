document.addEventListener("DOMContentLoaded", function () {
    const cateringForm = document.getElementById("catering-form");
    if (cateringForm) {
        cateringForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const bestelling = {
                type: "catering",
                items: {
                    "Premium Hiphop Burger": parseInt(document.getElementById("prod1").value) || 0,
                    "Moshpit Fries": parseInt(document.getElementById("prod2").value) || 0,
                    "Loud Energy Drink": parseInt(document.getElementById("prod3").value) || 0
                }
            };
            localStorage.setItem("bonnetje", JSON.stringify(bestelling));
            window.location.href = "bedankt.html";
        });
    }
    const ticketForm = document.getElementById("ticket-form");
    if (ticketForm) {
        ticketForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const bestelling = {
                type: "tickets",
                items: {
                    "Regular Ticket": parseInt(document.getElementById("ticket1").value) || 0,
                    "VIP Ticket": parseInt(document.getElementById("ticket2").value) || 0
                }
            };
            localStorage.setItem("bonnetje", JSON.stringify(bestelling));
            window.location.href = "bedankt.html";
        });
    }
    const receiptContainer = document.getElementById("receipt-data");
    if (receiptContainer) {
        const dataString = localStorage.getItem("bonnetje");
        if (dataString) {
            const data = JSON.parse(dataString);
            let htmlContent = "";
            let totaalPrijs = 0;
            let totaalItems = 0;
            const prijzenlijst = {
                "Premium Hiphop Burger": 5.99,
                "Moshpit Fries": 3.99,
                "Loud Energy Drink": 2.99,
                "Regular Ticket": 85.00, 
                "VIP Ticket": 150.00    
            };
            for (const [item, aantal] of Object.entries(data.items)) {
                if (aantal > 0) {
                    const prijsPerStuk = prijzenlijst[item] || 0;
                    const subTotaal = prijsPerStuk * aantal;
                    totaalPrijs += subTotaal;
                    totaalItems += aantal;
                    htmlContent += `
                        <div class="d-flex justify-content-between mb-2">
                            <span>${item} (${aantal}x)</span>
                            <span>€${subTotaal.toFixed(2)}</span>
                        </div>`;
                }
            }
            if (totaalItems === 0) {
                htmlContent = "<div>Geen items geselecteerd.</div>";
            } else {
                htmlContent += `
                    <hr style="border-top: 1px dashed #ffffff; margin: 15px 0;">
                    <div class="d-flex justify-content-between fw-bold" style="font-size: 1.2rem; color: #ff007f;">
                        <span>TOTAAL:</span>
                        <span>€${totaalPrijs.toFixed(2)}</span>
                    </div>`;
            }
            receiptContainer.innerHTML = htmlContent;
        } else {
            receiptContainer.innerHTML = "<div>Geen bestelgegevens gevonden.</div>";
        }
    }
});