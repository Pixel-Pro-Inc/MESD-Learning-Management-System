import { ComponentFixture, TestBed } from '@angular/core/testing';

import { RdepReviewComponent } from './rdep-review.component';

describe('RdepReviewComponent', () => {
  let component: RdepReviewComponent;
  let fixture: ComponentFixture<RdepReviewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ RdepReviewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(RdepReviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
