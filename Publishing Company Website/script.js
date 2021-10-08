var isNumberStarted = false;

window.onscroll = function() {
    let scrollTop = document.documentElement.scrollTop;
    
    if (scrollTop >= 710 && !isNumberStarted)
    {
        isNumberStarted = true;
        CallUpdateNumbers();
    }

};

function CallUpdateNumbers() {
    UpdateDataByTime(
        document.querySelector("#readers-num"),
        0,
        60000,
        100,
        1
    );
    
    UpdateDataByTime(
        document.querySelector("#pages-num"),
        0,
        650,
        20,
        50
    );
    
    UpdateDataByTime(
        document.querySelector("#coffee-num"),
        0,
        1435,
        45,
        50
    );
    
    UpdateDataByTime(
        document.querySelector("#fans-num"),
        0,
        16000,
        50,
        5
    );
    
}

function UpdateDataByTime(htmlContent, start, end, steps, time)
{
    var number = start;
    var updateInterval = setInterval(framePerTime, time);
    function framePerTime()
    {
        if (number <= end)
        {
            htmlContent.innerHTML = number; 
            number += steps;
        }
        else
        {
            htmlContent.innerHTML = end; 
            clearInterval(updateInterval);
        }
    }
}