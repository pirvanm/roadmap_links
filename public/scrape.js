const fs = require('fs');
const puppeteer = require('puppeteer');

(async () => {
    const outputFile = process.argv[2];
    const url = 'https://www.google.com/maps/search/firma+imobiliare/@44.4132947,26.1278258,15z?entry=ttu';

    try {
        const browser = await puppeteer.launch();
        const page = await browser.newPage();
        await page.goto(url, { waitUntil: 'networkidle2' });

        // Wait for the desired content to load, you may need to adjust the wait time based on the website
        await page.waitForTimeout(2000);

        const data = await page.evaluate(() => {
            const elements = Array.from(document.querySelectorAll('div.section-result'));

            // Extract the desired information
            const extractedData = elements.map(element => {
                const site = element.querySelector('span.section-result-details-container')?.textContent.trim() || 'N/A';
                const phone = element.querySelector('span.section-result-info.section-result-phone-number')?.textContent.trim() || 'N/A';
                const address = element.querySelector('span.section-result-location')?.textContent.trim() || 'N/A';

                return `Site: ${site}\nPhone: ${phone}\nAddress: ${address}\n`;
            });

            return extractedData;
        });

        await browser.close();

        fs.writeFileSync(outputFile, data.join('\n'));

        console.log(`Scraped data saved to ${outputFile}`);
    } catch (error) {
        console.error('An error occurred:', error);
    }
})();
