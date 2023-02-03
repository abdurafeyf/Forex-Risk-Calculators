const currencyPairSelect = document.getElementById("currency-pair");
const accountCurrencySelect = document.getElementById("account-currency");
const tradeSizeInput = document.getElementById("trade-size");
const openInput = document.getElementById("open-price");
const closeInput = document.getElementById("close-price");
const directionInput = document.getElementById("direction");
const calculateButton = document.getElementById("calculate-button");
const result = document.getElementById("result");

// on button click
calculateButton.addEventListener("click", event => {
    // prevent the default from submission behaviour
    event.preventDefault();
    // getting value and parsing into float
    const tradeSize = parseFloat(tradeSizeInput.value);
    const openPrice = parseFloat(openInput.value);
    const closePrice = parseFloat(closeInput.value);
    const direction = directionInput.value;
    const selectedCurrencyPair = currencyPairSelect.value;
    const selectedAccountCurrency = accountCurrencySelect.value;

    var baseCurrency = selectedCurrencyPair.slice(0, 3);
    var quoteCurrency = selectedCurrencyPair.slice(3, 6);
    var profit = parseFloat(0);
    var random = parseFloat(0);
    getRate("USD", quoteCurrency)
        .then((data) => {
            random = data;
        })
        .catch((error) => {
            console.log(error);
        })
    getRate(baseCurrency, quoteCurrency)
        .then((exchangeRate) => {
            if (direction === "buy") {
                profit = (openPrice - closePrice) * tradeSize * 100000 * -1;
            } else {
                profit = (openPrice - closePrice) * tradeSize * 100000 * 1;
            }

            if (quoteCurrency !== "USD" && baseCurrency === "USD") {
                profit = profit / exchangeRate;
            } else if (quoteCurrency !== "USD" && baseCurrency !== "USD") {
                profit = profit / random;
            }
            result.style.display = "block";
            if (profit === Infinity) {
                result.innerText = `Press the Button Again`;
            } else {
                result.innerText = `Result: ${profit.toFixed(4)} ${selectedAccountCurrency}`;
            }
        })
        .catch((error) => {
            console.log(error);
        })

});

function getRate(currencyFrom, currencyTo) {
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

    var urlencoded = new URLSearchParams();
    urlencoded.append("currencyFrom", currencyFrom);
    urlencoded.append("currencyTo", currencyTo);
    urlencoded.append("price", 1);

    var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: urlencoded,
        redirect: 'follow'
    };
    return new Promise((resolve, reject) => {
        fetch("https://sarmaaya.pk/api_prod/3.0/forex_calculator.php", requestOptions)
            .then(response => response.json())
            .then((data) => {
                resolve(data.data["conversion"]);
            })
            .catch(error => reject(error));
    });
}

var select = document.getElementById("currency-pair");
var options = select.options;
var arr = [];
for (var i = 0; i < options.length; i++) {
    arr.push(options[i]);
}
arr.sort(function(a, b) {
    return a.text == b.text ? 0 : (a.text > b.text ? 1 : -1);
});
for (var i = 0; i < arr.length; i++) {
    select.appendChild(arr[i]);
}