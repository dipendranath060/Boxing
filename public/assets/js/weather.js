let latitude;
let longitude;
let err = document.getElementById("weather-error");

const API_KEY = "3b097ec92b8702219134a12e470c86f6";

navigator.geolocation.getCurrentPosition(
    (pos) => {
        latitude = pos.coords.latitude;
        longitude = pos.coords.longitude;
        makeGetRequest(
            `https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=${API_KEY}&units=metric`
        );
    },
    function (error) {
        weatherimg.style.display = "none";
        switch (error.code) {
            case error.PERMISSION_DENIED:
                err.innerHTML = "User denied the request for geolocation.";
                break;
            case error.POSITION_UNAVAILABLE:
                err.innerHTML = "Location information is unavailable.";
                break;
            case error.TIMEOUT:
                err.innerHTML = "The request to get user location timed out.";
                break;
            case error.UNKNOWN_ERROR:
                err.innerHTML = "An unknown error occurred.";
                break;
        }
    }
);

let temp = document.getElementById("temp");
let weatherdescription = document.getElementById("weather-description");
let weatherlocation = document.getElementById("weather-location");
let weatherimg = document.getElementById("weatherimg");
function makeGetRequest(path) {
    axios.get(path).then(
        (response) => {
            var result = response.data;
            weatherimg.setAttribute(
                "src",
                `https://openweathermap.org/img/wn/${result.weather[0].icon}@2x.png`
            );
            temp.innerHTML = result.main.temp + "&deg C";
            weatherlocation.innerHTML = result.name + ", " + result.sys.country;
            weatherdescription.innerHTML = result.weather[0].description;
        },
        (error) => {
            err.innerHTML = error;
        }
    );
}

const date = new Date();
let min = date.getMinutes();
let m = min.toString();
if (m.length == 1) {
    min = "0" + min;
}
let time = date.getHours() + " : " + min;

let currenttime = document.getElementById("time");
currenttime.innerHTML = time;
