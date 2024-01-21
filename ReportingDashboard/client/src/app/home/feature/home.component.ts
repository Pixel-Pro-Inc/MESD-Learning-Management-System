import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css'],
})
export class HomeComponent implements OnInit {
  constructor(
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  ngOnInit(): void {
    var video = document.querySelector('video');
    video.muted = true;
    video.play();
  }

  verifyDocuments() {
    this.routerService.navigateByUrl('/verify');
  }

  certificates() {
    let prefs = this.preferencesService.getPreferences();

    if (prefs.user == null) {
      prefs.nextPage = '/portal/certificates-licenses';
      this.preferencesService.setPreferences(prefs);
      this.routerService.navigateByUrl('/sign-in');
      return;
    }

    this.routerService.navigateByUrl('/portal/certificates-licenses');
  }

  permits() {
    let prefs = this.preferencesService.getPreferences();

    if (prefs.user == null) {
      prefs.nextPage = '/portal/permits';
      this.preferencesService.setPreferences(prefs);
      this.routerService.navigateByUrl('/sign-in');
      return;
    }

    this.routerService.navigateByUrl('/portal/permits');
  }
}
