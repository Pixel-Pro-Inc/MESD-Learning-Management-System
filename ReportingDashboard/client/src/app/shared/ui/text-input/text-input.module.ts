import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ReactiveFormsModule } from '@angular/forms';
import { TextInputComponent } from './text-input.component';
import { InputTextModule } from 'primeng/inputtext';

@NgModule({
  declarations: [TextInputComponent],
  imports: [CommonModule, ReactiveFormsModule, InputTextModule],
  exports: [TextInputComponent],
})
export class TextInputModule {}
