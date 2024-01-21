import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NavModule } from './nav/nav.module';
import { CheckmarkModule } from './checkmark/checkmark.module';
import { RadioButtonModule } from './radio-button/radio-button.module';
import { TextInputModule } from './text-input/text-input.module';
import { MapModule } from './map/map.module';
import { CountryCodeSelectionModule } from './country-code-selection/country-code-selection.module';
import { BtnModule } from './btn/btn.module';
@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    NavModule,
    CheckmarkModule,
    RadioButtonModule,
    TextInputModule,
    MapModule,
    CountryCodeSelectionModule,
    BtnModule,
  ],
  exports: [
    NavModule,
    CheckmarkModule,
    RadioButtonModule,
    TextInputModule,
    MapModule,
    CountryCodeSelectionModule,
    BtnModule,
  ],
})
export class SharedUiModule {}
