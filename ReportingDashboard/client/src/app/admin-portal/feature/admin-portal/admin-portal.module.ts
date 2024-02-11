import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AdminPortalRoutingModule } from './admin-portal-routing.module';
import { AdminPortalComponent } from './admin-portal.component';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { TooltipModule } from 'primeng/tooltip';

@NgModule({
  declarations: [AdminPortalComponent],
  imports: [
    CommonModule,
    AdminPortalRoutingModule,
    SharedUiModule,
    TooltipModule,
  ],
})
export class AdminPortalModule {}
