import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root',
})
export class CountryCodeService {
  private countriesApiUrl = 'https://restcountries.com/v3.1/all'; // Replace this with the API URL or JSON file URL

  constructor(private http: HttpClient) {}

  getCountries() {
    return this.http
      .get(this.countriesApiUrl)
      .toPromise()
      .then((countriesData: any[]) => {
        return countriesData.map((countryData) => {
          if (countryData.idd.suffixes != null) {
            const country: any = {
              name: countryData.cca3,
              fullName: countryData.name.common,
              dialingCode:
                (countryData.idd.root + countryData.idd.suffixes[0]).length > 4
                  ? countryData.idd.root
                  : countryData.idd.root + countryData.idd.suffixes[0],
              flagImg: countryData.flags.png,
              flagEmoji: this.getFlagEmoji(countryData.cca2),
            };

            return country;
          }
        });
      });
  }

  private getFlagEmoji(countryCode) {
    const codePoints = countryCode
      .toUpperCase()
      .split('')
      .map((char) => 127397 + char.charCodeAt());

    return String.fromCodePoint(...codePoints);
  }
}
