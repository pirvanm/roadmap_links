const fs = require('fs'); const path = require('path'); const puppeteer = require('puppeteer'); (async () => { const outputFile = path.join(__dirname, '../public/scraped_data.txt'); const url = 'https://www.google.com/maps/search/firma+imobiliare/@44.4132947,26.1278258,15z?entry=ttu'; const browser = await puppeteer.launch(); const page = await browser.newPage(); await page.goto(url); await page.waitForNavigation(); const data = await page.evaluate(() => { const elements = Array.from(document.querySelectorAll('div.section-result')); const data = []; elements.forEach((element) => { const site = element.querySelector('span.section-result-details-container'); const phone = element.querySelector('span.section-result-info.section-result-phone-number'); const address = element.querySelector('span.section-result-location'); const siteText = site ? site.textContent.trim() : 'N/A'; const phoneText = phone ? phone.textContent.trim() : 'N/A'; const addressText = address ? address.textContent.trim() : 'N/A'; data.push(`Site: ${siteText}\nPhone: ${phoneText}\nAddress: ${addressText}\n`); }); return data; }); await browser.close(); fs.writeFileSync(outputFile, data.join('\n')); console.log(`Scraped data saved to ${outputFile}`); })();