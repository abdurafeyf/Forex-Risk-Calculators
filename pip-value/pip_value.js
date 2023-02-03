const currencyPairSelect = document.getElementById("currency-pair");
const accountCurrencySelect = document.getElementById("account-currency");
const calculateButton = document.getElementById("calculate-button");
const tradeSizeInput = document.getElementById("trade-size");
const pipsInput = document.getElementById("pips");
const result = document.getElementById("result");

// on button click
calculateButton.addEventListener("click", event => {
    // prevent the default from submission behaviour
    event.preventDefault();
    // getting value and parsing into float
    const tradeSize = parseFloat(tradeSizeInput.value);
    const pips = parseFloat(pipsInput.value);
    const selectedCurrencyPair = currencyPairSelect.value;
    const selectedAccountCurrency = accountCurrencySelect.value;
    // initializing pip value
    var pip_value = 0;
    var baseCurrency = selectedCurrencyPair.slice(0, 3);
    var quoteCurrency = selectedCurrencyPair.slice(3, 6);
    var pipSize = (quoteCurrency === "JPY") ? 0.01 : 0.0001;
    var if_jpy = (quoteCurrency === "JPY") ? 100 : 1;
    var random = parseFloat(0)

    getRate("USD", quoteCurrency)
        .then((data) => {
            random = data;
        })
        .catch((error) => {
            console.log(error);
        })
    getRate(baseCurrency, quoteCurrency)
        .then((exchangeRate) => {
            if (quoteCurrency === "USD") {
                pip_value = 10;
            } else if (baseCurrency === "USD") {
                pip_value = (10 / exchangeRate);
            } else {
                pip_value = (10 / random);
            }
            pip_value = pip_value * if_jpy * tradeSize;
            let lots = (pip_value / tradeSize) * pips;
            result.style.display = "block";
            if (pip_value === Infinity) {
                result.innerText = `Price: ${exchangeRate}
        Press the Button Again`;
            } else {
                result.innerText = `Price: ${exchangeRate}
        Pip Value: ${(pip_value).toFixed(4)} ${selectedAccountCurrency}
        Standard Lot: ${(lots).toFixed(4)}
        Mini Lot: ${(lots/10).toFixed(4)}
        Micro Lot: ${(lots/100).toFixed(4)}`;
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