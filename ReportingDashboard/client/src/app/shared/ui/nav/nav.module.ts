import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NavComponent } from './nav.component';
import { BtnModule } from '../btn/btn.module';
import { TooltipModule } from 'primeng/tooltip';
import { RouterModule } from '@angular/router';

@NgModule({
  declarations: [NavComponent],
  imports: [CommonModule, BtnModule, TooltipModule, RouterModule],
  exports: [NavComponent],
})
export class NavModule {}
