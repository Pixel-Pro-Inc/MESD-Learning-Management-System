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
    private preferencesService: PreferencesService
  ) {}

  ngOnInit(): void {}

  next() {
    this.busyService.busy();

    let prefs = this.preferencesService.getPreferences();

    const mergedJSON = Object.assign(
      {},
      prefs.permitFormsPersistence.service,
      prefs.permitFormsPersistence.psdl1,
      prefs.permitFormsPersistence.psdl2,
      prefs.permitFormsPersistence.psdl3,
      prefs.permitFormsPersistence.psdl4
    );

    let applicationModel = {
      user: prefs.user,
      application: mergedJSON,
    };

    this.documentsService.applyCertificate(applicationModel).subscribe(
      (response) => {
        //Clear form data
        //Clear steps menu
        prefs.certFormsPersistence = null;
        prefs.currentCertFormSelected = null;

        this.preferencesService.setPreferences(prefs);

        //Navigate to documents page
        this.routerService.navigateByUrl('/portal/my-applications');

        this.busyService.idle();
      },
      (error) => {
        this.busyService.idle();
        this.toastService.error(error.error, 'Error');
      }
    );
  }

  previous() {
    this.routerService.navigateByUrl('/portal/permits/rdep-information-4');
  }
}
