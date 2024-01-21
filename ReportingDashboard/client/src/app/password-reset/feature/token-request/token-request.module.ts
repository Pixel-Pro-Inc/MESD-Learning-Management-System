import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { TokenRequestRoutingModule } from './token-request-routing.module';
import { TokenRequestComponent } from './token-request.component';
import { SharedUiModule } from 'src/app/shared/ui/shared-ui.module';
import { ReactiveFormsModule } from '@angular/forms';

@NgModule({
  declarations: [TokenRequestComponent],
  imports: [
    CommonModule,
    TokenRequestRoutingModule,
    SharedUiModule,
    ReactiveFormsModule,
  ],
})
export class TokenRequestModule {}
