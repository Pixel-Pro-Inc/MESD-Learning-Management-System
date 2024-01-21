import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { PsdlConfirmationRoutingModule } from './psdl-confirmation-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { PsdlConfirmationComponent } from './psdl-confirmation.component';

@NgModule({
  declarations: [PsdlConfirmationComponent],
  imports: [
    CommonModule,
    PsdlConfirmationRoutingModule,
    ReactiveFormsModule,
    SharedUiModule,
  ],
})
export class PsdlConfirmationModule {}
