import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NavModule } from './nav/nav.module';
import { TextInputModule } from './text-input/text-input.module';
import { BtnModule } from './btn/btn.module';
@NgModule({
  declarations: [],
  imports: [CommonModule, NavModule, TextInputModule, BtnModule],
  exports: [NavModule, TextInputModule, BtnModule],
})
export class SharedUiModule {}
