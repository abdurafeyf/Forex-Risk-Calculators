const accountSizeInputPrice = document.getElementById("account-sizePrice");
const riskPercentageInputPrice = document.getElementById("risk-percentagePrice");
const currencyPairSelectPrice = document.getElementById("currency-pairPrice");
const accountCurrencySelectPrice = document.getElementById("account-currencyPrice");
const entryPriceInputPrice = document.getElementById("entry-pricePrice");
const stopPriceInputPrice = document.getElementById("stop-pricePrice");
const calculateButtonPrice = document.getElementById("calculate-buttonPrice");
const resultPrice = document.getElementById("resultPrice");

// on button click
calculateButtonPrice.addEventListener("click", event => {
    // prevent the default from submission behaviour
    event.preventDefault();
    // getting value and parsing into float
    const accountSize = parseFloat(accountSizeInputPrice.value);
    const riskPercentage = parseFloat(riskPercentageInputPrice.value);
    // const tradeSize = parseFloat(tradeSizeInput.value);
    const tradeSize = parseFloat(1);
    const selectedCurrencyPair = currencyPairSelectPrice.value;
    const selectedAccountCurrency = accountCurrencySelectPrice.value;
    const entryPrice = parseFloat(entryPriceInputPrice.value);
    const stopPrice = parseFloat(stopPriceInputPrice.value);
    // initializing pip value
    var pip_value = 0;
    var baseCurrency = selectedCurrencyPair.slice(0, 3);
    var quoteCurrency = selectedCurrencyPair.slice(3, 6);
    var if_jpy = (quoteCurrency === "JPY") ? 100 : 1;
    var val_jpy = (quoteCurrency === "JPY") ? 1000 : 10;
    var random = parseFloat(0);
    var stopLoss = parseFloat(0);
    if (quoteCurrency == "JPY" || baseCurrency == "JPY") {
        stopLoss = Math.abs(entryPrice - stopPrice) * 100000;
        console.log(stopLoss);
    }
    else {
        stopLoss = Math.abs(entryPrice - stopPrice) * 100000;
    }

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
            }
            else if (baseCurrency === "USD") {
                pip_value = 10 / exchangeRate;
            }
            else {
                pip_value = 10 / random;
            }
            let standardLots = (accountSize * (riskPercentage / 100)) / (stopLoss * pip_value);
            resultPrice.style.display = "block";
            if (pip_value === Infinity) {
                resultPrice.innerText = `Amount at Risk: ${accountSize * (riskPercentage / 100)} ${selectedAccountCurrency} 
            Press the button again`;
            }
            else {
                resultPrice.innerText = `Amount at Risk: ${accountSize * (riskPercentage / 100)} ${selectedAccountCurrency} 
            Sizing: ${(standardLots / if_jpy * val_jpy).toFixed(2)} Lots`;
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

for (const key in currencyPairs) {
    const option = document.createElement('option');
    option.value = key;
    option.text = currencyPairs[key];
    currencyPairSelectPrice.appendChild(option);
}

var selectPrice = document.getElementById("currency-pairPrice");
var optionsPrice = selectPrice.options;
var arrPrice = [];
for (var i = 0; i < optionsPrice.length; i++) {
    arrPrice.push(optionsPrice[i]);
}
arrPrice.sort(function (a, b) {
    return a.text == b.text ? 0 : (a.text > b.text ? 1 : -1);
});
for (var i = 0; i < arrPrice.length; i++) {
    selectPrice.appendChild(arrPrice[i]);
}
