

export function getMonth(value){
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"]

    return months[value]
}

export function getDay(value){
    const months = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday']

    return months[value]
}

export function getAllDayInMonth(currentMonth){
    let currentDate = new Date(new Date().getFullYear(), currentMonth);
    let fullYear = currentDate.getFullYear();
    let month = currentDate.getMonth();
    currentDate.setDate(1)
    let first_date = new Date(currentDate)
    first_date.setDate(-(first_date.getDay() - 2))
    let afterMonth = new Date(fullYear, month + 1)
    let last_date = afterMonth
    last_date.setDate(0)
    last_date.setDate(last_date.getDate() + (8 - last_date.getDay()))
    let dateContainer = []

    while(first_date < last_date){
        dateContainer.push(new Date(first_date))
        first_date.setDate(first_date.getDate() + 1)
    }

    return dateContainer
}


export function mainTab(){
    const shuffledArray = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j']
    for (let i = shuffledArray.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [shuffledArray[i], shuffledArray[j]] = [shuffledArray[j], shuffledArray[i]];
    }

    sessionStorage.setItem('notification_id');
    sessionStorage.setItem('');
}
