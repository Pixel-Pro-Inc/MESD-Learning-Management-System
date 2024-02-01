import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ProfilingComponent } from './profiling.component';
import { ProfilingRoutingModule } from './profiling-routing.module';
import { NgxChartsModule } from '@swimlane/ngx-charts';
import { TableModule } from 'primeng/table';

@NgModule({
  declarations: [ProfilingComponent],
  imports: [CommonModule, ProfilingRoutingModule, NgxChartsModule, TableModule],
})
export class ProfilingModule { }
