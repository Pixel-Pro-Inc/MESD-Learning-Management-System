import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CountryCodeSelectionComponent } from './country-code-selection.component';
import { DropdownModule } from 'primeng/dropdown';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  declarations: [CountryCodeSelectionComponent],
  imports: [CommonModule, DropdownModule, ReactiveFormsModule],
  exports: [CountryCodeSelectionComponent],
})
export class CountryCodeSelectionModule {}
