import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { BehaviorSubject, Observable } from 'rxjs';
import { map } from 'rxjs/operators';
import { PreferencesService } from '../../services/preferences-service/preferences.service';
import { BillingService } from '../../services/billing-service/billing.service';

@Injectable({
  providedIn: 'root',
})
export class SubscriptionGuard implements CanActivate {
  constructor(
    private preferencesService: PreferencesService,
    private billingService: BillingService,
    private routerService: Router
  ) {}

  subscriptionValid: BehaviorSubject<boolean> = null;

  canActivate(): Observable<boolean> {
    if (this.subscriptionValid) {
      return this.subscriptionValid;
    }

    return this.billingService
      .getPastDueInvoices({
        branchId: this.preferencesService.getPreferences().branchId,
        invoiceNumber: null,
      })
      .pipe(
        map((response) => {
          if (response.length != 0) {
            this.routerService.navigateByUrl(
              '/admin-portal/reports-unavailable'
            );
          }

          this.subscriptionValid = new BehaviorSubject<boolean>(true);

          return true;
        })
      );
  }
}
