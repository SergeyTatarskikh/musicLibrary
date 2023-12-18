// Получаем ссылки на поля ввода
var yearInput = document.getElementById('year-input');
var executorInput = document.getElementById('executor-input');
var albumInput = document.getElementById('album-input');

// Добавляем обработчик события на изменение значения поля ввода
yearInput.addEventListener('input', validateYear);
executorInput.addEventListener('input', validateExecutor);
albumInput.addEventListener('input', validateAlbum);

// Функция для проверки и подсветки поля
function validateInput(inputElement, regexPattern = null, minValue = null, maxValue = null) {
    var inputValue = inputElement.value;
    var isValid = true;

    if (regexPattern !== null) {
        isValid = regexPattern.test(inputValue);
    }

    if (minValue !== null) {
        isValid = isValid && inputValue >= minValue;
    }

    if (maxValue !== null) {
        isValid = isValid && inputValue <= maxValue;
    }

    if (isValid) {
        inputElement.classList.remove('is-invalid'); // Удаляем класс is-invalid, если значение корректно
    } else {
        inputElement.classList.add('is-invalid'); // Добавляем класс is-invalid, если значение некорректно
    }
}

// Функция для проверки и подсветки поля Год
function validateYear() {
    var currentYear = new Date().getFullYear();
    validateInput(yearInput, /^\d{4}$/, 1900, currentYear);
}

// Функция для проверки и подсветки поля Исполнитель
function validateExecutor() {
    validateInput(executorInput, /^[a-zA-Zа-яА-Я\s]+$/u);
}

// Функция для проверки и подсветки поля Альбом
function validateAlbum() {
    validateInput(albumInput, null, null, null);
}

function toggleButtonText(button) {
    var saveButton = document.querySelector('.save-button'); // Находим кнопку "Сохранить"
    if (button.innerHTML === 'Изменить') {
        if (saveButton) {
            saveButton.innerHTML = 'Изменить'; // Возвращаем предыдущей кнопке "Сохранить" название "Изменить"
            saveButton.classList.remove('save-button'); // Удаляем класс "save-button" у предыдущей кнопки "Сохранить"
        }
        button.innerHTML = 'Сохранить';
        button.classList.add('save-button'); // Добавляем класс "save-button" к текущей кнопке "Сохранить"
        var row = button.closest('tr');
        var cells = row.getElementsByTagName('td');
        yearInput.value = cells[1].innerText;
        executorInput.value = cells[2].innerText;
        albumInput.value = cells[3].innerText;
    } else if (button.innerHTML === 'Сохранить') {
        document.querySelector('form').submit();
    }
}
