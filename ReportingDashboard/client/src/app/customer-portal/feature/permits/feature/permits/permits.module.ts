import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PermitsComponent } from './permits.component';
import { PermitsRoutingModule } from './permits-routing.module';
import { BadgeModule } from 'primeng/badge';
import { StepsModule } from 'primeng/steps';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';

@NgModule({
  declarations: [PermitsComponent],
  imports: [
    CommonModule,
    PermitsRoutingModule,
    BadgeModule,
    SharedUiModule,
    StepsModule,
  ],
})
export class PermitsModule {}
