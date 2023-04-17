const currencyPairSelectProfit = document.getElementById("currency-pairProfit");
const accountCurrencySelectProfit = document.getElementById("account-currencyProfit");
const tradeSizeInputProfit = document.getElementById("trade-sizeProfit");
const openInputProfit = document.getElementById("open-priceProfit");
const closeInputProfit = document.getElementById("close-priceProfit");
const directionInputProfit = document.getElementById("directionProfit");
const calculateButtonProfit = document.getElementById("calculate-buttonProfit");
const resultProfit = document.getElementById("resultProfit");

// on button click
calculateButtonProfit.addEventListener("click", event => {
    // prevent the default from submission behaviour
    event.preventDefault();
    // getting value and parsing into float
    const tradeSize = parseFloat(tradeSizeInputProfit.value);
    const openPrice = parseFloat(openInputProfit.value);
    const closePrice = parseFloat(closeInputProfit.value);
    const direction = directionInputProfit.value;
    const selectedCurrencyPair = currencyPairSelectProfit.value;
    const selectedAccountCurrency = accountCurrencySelectProfit.value;

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
            resultProfit.style.display = "block";
            if (profit === Infinity) {
                resultProfit.innerText = `Press the Button Again`;
            } else {
                resultProfit.innerText = `Result: ${profit.toFixed(4)} ${selectedAccountCurrency}`;
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
    currencyPairSelectProfit.appendChild(option);
}

var selectProfit = document.getElementById("currency-pairProfit");
var optionsProfit = selectProfit.options;
var arrProfit = [];
for (var i = 0; i < optionsProfit.length; i++) {
    arrProfit.push(optionsProfit[i]);
}
arrProfit.sort(function (a, b) {
    return a.text == b.text ? 0 : (a.text > b.text ? 1 : -1);
});
for (var i = 0; i < arrProfit.length; i++) {
    selectProfit.appendChild(arrProfit[i]);
}