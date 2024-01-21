import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { MyApplicationsRoutingModule } from './my-applications-routing.module';
import { MyApplicationsComponent } from './my-applications.component';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { BadgeModule } from 'primeng/badge';
import { TooltipModule } from 'primeng/tooltip';

@NgModule({
  declarations: [MyApplicationsComponent],
  imports: [
    CommonModule,
    MyApplicationsRoutingModule,
    SharedUiModule,
    BadgeModule,
    TooltipModule,
  ],
})
export class MyApplicationsModule {}
