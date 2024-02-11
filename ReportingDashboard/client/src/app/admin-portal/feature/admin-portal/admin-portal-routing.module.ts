import { NgModule } from '@angular/core';
import { AdminPortalComponent } from './admin-portal.component';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
  {
    path: '',
    component: AdminPortalComponent,
    children: [
      {
        path: 'dashboard',
        canActivate: [],
        loadChildren: () =>
          import('../dashboard/dashboard.module').then(
            (m) => m.DashboardModule
          ),
      },
      {
        path: 'profiling',
        canActivate: [],
        loadChildren: () =>
          import('../profiling/profiling.module').then(
            (m) => m.ProfilingModule
          ),
      },
      {
        path: 'school-analysis',
        loadChildren: () =>
          import('../school-analysis/school-analysis.module').then(
            (m) => m.SchoolAnalysisModule
          ),
      },
      { path: '**', redirectTo: 'dashboard', pathMatch: 'full' },
    ],
  },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class AdminPortalRoutingModule {}
