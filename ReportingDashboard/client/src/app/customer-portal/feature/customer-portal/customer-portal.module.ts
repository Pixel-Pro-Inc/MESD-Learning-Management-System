import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CustomerPortalRoutingModule } from './customer-portal-routing.module';
import { CustomerPortalComponent } from './customer-portal.component';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { TooltipModule } from 'primeng/tooltip';

@NgModule({
  declarations: [CustomerPortalComponent],
  imports: [
    CommonModule,
    CustomerPortalRoutingModule,
    SharedUiModule,
    TooltipModule,
  ],
})
export class CustomerPortalModule {}
