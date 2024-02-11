import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { BtnComponent } from './btn.component';
import { ButtonModule } from 'primeng/button';

@NgModule({
  declarations: [BtnComponent],
  imports: [CommonModule, ButtonModule],
  exports: [BtnComponent],
})
export class BtnModule {}
