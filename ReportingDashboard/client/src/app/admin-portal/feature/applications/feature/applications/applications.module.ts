import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ApplicationsComponent } from './applications.component';
import { ApplicationsRoutingModule } from './applications-routing.module';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';

@NgModule({
  declarations: [ApplicationsComponent],
  imports: [CommonModule, ApplicationsRoutingModule, SharedUiModule],
})
export class ApplicationsModule {}
