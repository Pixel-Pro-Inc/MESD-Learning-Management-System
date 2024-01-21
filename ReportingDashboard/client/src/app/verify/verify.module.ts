import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { VerifyComponent } from './verify.component';
import { VerifyRoutingModule } from './verify-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from '../shared/ui/shared-ui.module';
import { BadgeModule } from 'primeng/badge';

@NgModule({
  declarations: [VerifyComponent],
  imports: [
    CommonModule,
    VerifyRoutingModule,
    ReactiveFormsModule,
    SharedUiModule,
    BadgeModule
  ],
})
export class VerifyModule {}
