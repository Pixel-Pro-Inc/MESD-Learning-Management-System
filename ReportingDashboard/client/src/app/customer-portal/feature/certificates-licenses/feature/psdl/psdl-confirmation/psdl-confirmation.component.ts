import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { BusyService } from 'src/app/shared/services/busy-service/busy.service';
import { DocumentsService } from 'src/app/shared/services/documents-service/documents.service';
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
      prefs.certFormsPersistence.service,
      prefs.certFormsPersistence.psdl1,
      prefs.certFormsPersistence.psdl2,
      prefs.certFormsPersistence.psdl3,
      prefs.certFormsPersistence.psdl4,
      prefs.certFormsPersistence.psdl5,
      prefs.certFormsPersistence.psdl6,
      prefs.certFormsPersistence.psdl7,
      prefs.certFormsPersistence.psdl8,
      prefs.certFormsPersistence.psdl9,
      prefs.certFormsPersistence.psdl10,
      prefs.certFormsPersistence.psdl11
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
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-11'
    );
  }
}
