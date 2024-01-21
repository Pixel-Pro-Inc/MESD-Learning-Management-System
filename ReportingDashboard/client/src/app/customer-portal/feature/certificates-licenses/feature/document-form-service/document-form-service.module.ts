import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { DocumentFormServiceRoutingModule } from './document-form-service-routing.module';
import { ReactiveFormsModule } from '@angular/forms';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { DocumentFormServiceComponent } from './document-form-service.component';
import { DropdownModule } from 'primeng/dropdown';

@NgModule({
  declarations: [DocumentFormServiceComponent],
  imports: [
    CommonModule,
    DocumentFormServiceRoutingModule,
    ReactiveFormsModule,
    DropdownModule,
    SharedUiModule,
  ],
})
export class DocumentFormServiceModule {}
