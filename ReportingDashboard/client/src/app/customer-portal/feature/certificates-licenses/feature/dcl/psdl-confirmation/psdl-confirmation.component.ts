import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { DocumentsService } from 'src/app/shared/services/documents-service/documents.service';
import { PaymentService } from 'src/app/shared/services/payment-service/payment.service';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-confirmation',
  templateUrl: './psdl-confirmation.component.html',
  styleUrls: ['./psdl-confirmation.component.css'],
})
export class PsdlConfirmationComponent implements OnInit {
  constructor(
    private routerService: Router,
    private toastService: ToastrService,
    private paymentService: PaymentService,
    private busyService: BusyService,
    private documentsService: DocumentsService,
    private preferencesService: PreferencesService,
    private route: ActivatedRoute
  ) {
    this.route.queryParams.subscribe((params) => {
      if (params['result'] == 'success') {
        toastService.success('Payment successful');

        //Navigate to next page
        routerService.navigateByUrl('/portal/my-applications');
      }

      if (params['result'] == 'fail') {
        toastService.error('Payment failed');
      }
    });
  }

  ngOnInit(): void {}

  next() {
    //Pay
    let prefs = this.preferencesService.getPreferences();

    const mergedJSON = Object.assign(
      {},
      prefs.certFormsPersistence.service,
      prefs.certFormsPersistence.psdl1,
      prefs.certFormsPersistence.psdl2,
      prefs.certFormsPersistence.psdl3,
      prefs.certFormsPersistence.psdl4,
      prefs.certFormsPersistence.psdl5,
      prefs.certFormsPersistence.psdl6
    );

    let applicationModel = {
      user: prefs.user,
      application: mergedJSON,
    };

    this.paymentService.processPayment({
      ID: '',
      Price: '500',
      PayerId: this.preferencesService.getPreferences().user.email,
      PayeeId: '',
      ReturnUrl: '/portal/certificates-licenses/dcl-confirmation',
      RegisterCertificateLicenseDto: applicationModel,
    });
  }

  previous() {
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/dcl-information-6'
    );
  }
}
