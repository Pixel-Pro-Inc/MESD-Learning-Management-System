import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { CertificatesLicensesComponent } from './certificates-licenses.component';
import { CertificatesLicensesRoutingModule } from './certificates-licenses-routing.module';
import { BadgeModule } from 'primeng/badge';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { StepsModule } from 'primeng/steps';

@NgModule({
  declarations: [CertificatesLicensesComponent],
  imports: [
    CommonModule,
    CertificatesLicensesRoutingModule,
    BadgeModule,
    SharedUiModule,
    StepsModule,
  ],
})
export class CertificatesLicensesModule {}
