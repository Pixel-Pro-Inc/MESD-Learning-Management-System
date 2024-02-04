import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './shared/guards/auth/auth.guard';

const routes: Routes = [
  {
    path: 'login',
    loadChildren: () =>
      import('./login/feature/login.module').then((m) => m.LoginModule),
  },
  {
    path: 'report-portal',
    canActivate: [AuthGuard],
    loadChildren: () =>
      import(
        './admin-portal/feature/admin-portal-shell/admin-portal-shell.module'
      ).then((m) => m.AdminPortalShellModule),
  },
  { path: '**', redirectTo: 'login', pathMatch: 'full' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
})
export class AppRoutingModule { }
