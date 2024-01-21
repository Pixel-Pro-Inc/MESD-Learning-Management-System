import { ComponentFixture, TestBed } from '@angular/core/testing';

import { KpcReviewComponent } from './kpc-review.component';

describe('KpcReviewComponent', () => {
  let component: KpcReviewComponent;
  let fixture: ComponentFixture<KpcReviewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ KpcReviewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(KpcReviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
