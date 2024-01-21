import { Component, Input, Self } from '@angular/core';
import { CountryCodeService } from '../../services/country-service/country-code.service';
import { ControlValueAccessor, NgControl } from '@angular/forms';
import { PreferencesService } from '../../services/preferences-service/preferences.service';
import { Preferences } from '../../models/preferences';

@Component({
  selector: 'app-country-code-selection',
  templateUrl: './country-code-selection.component.html',
  styleUrls: ['./country-code-selection.component.css'],
})
export class CountryCodeSelectionComponent implements ControlValueAccessor {
  @Input() defaultCountryName: string;
  @Input() defaultDialingCode: string;
  countries: any[] = [];

  constructor(
    @Self() public ngControl: NgControl,
    private countryCodeService: CountryCodeService,
    private preferencesService: PreferencesService
  ) {
    this.ngControl.valueAccessor = this;

    this.countryCodeService.getCountries().then((countries: any[]) => {
      this.countries = countries.filter((element) => element != null);

      if (this.defaultCountryName == null && this.defaultDialingCode == null) {
        return;
      }

      let country = this.countries.filter(
        (element) =>
          element.name == this.defaultCountryName ||
          element.dialingCode == this.defaultDialingCode
      )[0];

      this.ngControl.control.setValue(country);

      let prefs: Preferences = this.preferencesService.getPreferences();

      if (prefs.countryDialingCode) {
        let _country = this.countries.filter(
          (element) => element.dialingCode == prefs.countryDialingCode
        )[0];

        this.ngControl.control.setValue(_country);
      }
    });
  }

  writeValue(obj: any): void {}
  registerOnChange(fn: any): void {}
  registerOnTouched(fn: any): void {}
}
