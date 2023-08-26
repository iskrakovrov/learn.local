(async () => {




    // Выполняем вход в аккаунт (здесь необходимо ввести логин и пароль)

    // Прокручиваем страницу до конца
    await scrollToEnd(page);

    // Пауза для просмотра результатов
    await page.waitForTimeout(5000);


})();

// Функция для прокрутки страницы до конца
async function scrollToEnd(page) {
    await page.evaluate(async () => {
        await new Promise((resolve, reject) => {
            const scrollHeight = document.body.scrollHeight;
            const distance = 100;
            let currentPosition = 0;

            const scrollInterval = setInterval(() => {
                window.scrollBy(0, distance);
                currentPosition += distance;

                if (currentPosition >= scrollHeight) {
                    clearInterval(scrollInterval);
                    resolve();
                }
            }, 100);
        });
    });
}